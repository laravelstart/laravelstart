import Footer from '@/Components/Footer';
import MobileAlert from '@/Components/MobileAlert';
import Providers from '@/Layouts/Providers';
import {
    Button,
    Dropdown,
    DropdownItem,
    DropdownMenu,
    DropdownSection,
    DropdownTrigger,
    Image,
} from '@heroui/react';
import { Link, router, usePage } from '@inertiajs/react';
import { PropsWithChildren } from 'react';
import { isMobile } from 'react-device-detect';
import { FaCog, FaDoorOpen, FaGithubSquare } from 'react-icons/fa';
import logo from '../../images/logo_icon.webp';

export default function MinimalAppLayout({ children }: PropsWithChildren) {
    const user = usePage().props.auth.user;

    return (
        <Providers>
            <div className="flex min-h-screen flex-col bg-background/40">
                {isMobile && <MobileAlert className="mb-2" />}
                <header className="fixed w-full bg-background/50">
                    <div className="mx-auto max-w-7xl px-6">
                        <div className="flex h-16 items-center justify-between">
                            {user && (
                                <Link
                                    href="/dashboard"
                                    className="flex items-center gap-x-6"
                                >
                                    <div className="flex items-center gap-x-3">
                                        <Image
                                            src={logo}
                                            className="h-9"
                                            radius="none"
                                        />

                                        <span className="text-xl font-bold">
                                            Laravel Start
                                        </span>
                                    </div>
                                </Link>
                            )}
                            {!user && (
                                <a href="/">
                                    <div className="flex items-center gap-x-3">
                                        <Image
                                            src={logo}
                                            className="h-9"
                                            radius="none"
                                        />

                                        <span className="text-xl font-bold">
                                            Laravel Start
                                        </span>
                                    </div>
                                </a>
                            )}
                            <div className="flex items-center gap-x-2">
                                {!user && (
                                    <Button
                                        as={Link}
                                        color="primary"
                                        size="lg"
                                        href="/login"
                                    >
                                        Sign In
                                    </Button>
                                )}

                                {user && (
                                    <Dropdown placement="bottom-end">
                                        <DropdownTrigger>
                                            <Button
                                                isIconOnly
                                                variant="light"
                                                className="text-default-600"
                                                size="lg"
                                            >
                                                <FaCog size={18} />
                                            </Button>
                                        </DropdownTrigger>
                                        <DropdownMenu aria-label="Account Actions">
                                            <DropdownSection
                                                title={`Signed in as ${user.name}`}
                                            >
                                                <DropdownItem
                                                    as={Link}
                                                    href="/manage-github"
                                                    key="manage-github"
                                                    startContent={
                                                        <FaGithubSquare />
                                                    }
                                                >
                                                    Manage Github integration
                                                </DropdownItem>

                                                <DropdownItem
                                                    key="sign-out"
                                                    // @ts-expect-error
                                                    method="post"
                                                    className="text-left text-danger"
                                                    color="danger"
                                                    startContent={
                                                        <FaDoorOpen />
                                                    }
                                                    onPress={() =>
                                                        router.post('/logout')
                                                    }
                                                >
                                                    Sign out
                                                </DropdownItem>
                                            </DropdownSection>
                                        </DropdownMenu>
                                    </Dropdown>
                                )}
                            </div>
                        </div>
                    </div>
                </header>

                <main className="flex-1">{children}</main>

                <Footer />
            </div>
        </Providers>
    );
}

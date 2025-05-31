import BoxWithInitials from '@/Components/BoxWithInitials';
import CreateKitModal from '@/Components/CreateKit/CreateKitModal';
import CreateProjectModal from '@/Components/CreateProject/CreateProjectModal';
import Footer from '@/Components/Footer';
import MobileAlert from '@/Components/MobileAlert';
import useCreateKitModal from '@/hooks/useCreateKitModal';
import useSelectKit from '@/hooks/useSelectKit';
import Providers from '@/Layouts/Providers';
import {
    Button,
    Divider,
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
import {
    FaCog,
    FaCompass,
    FaDoorOpen,
    FaGithubAlt,
    FaGithubSquare,
    FaUser,
} from 'react-icons/fa';
import { HiSparkles } from 'react-icons/hi';
import logo from '../../images/logo_icon.webp';

export default function AppLayout({ children }: PropsWithChildren) {
    const user = usePage().props.auth.user;
    const { selectedKit, onSelectKit } = useSelectKit();
    const createKitModal = useCreateKitModal();

    return (
        <Providers>
            <div className="flex min-h-screen flex-col bg-background/40">
                {isMobile && <MobileAlert className="mb-2" />}
                <header className="border-b border-divider bg-background">
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

                                    <Divider
                                        className="h-6"
                                        orientation="vertical"
                                    />

                                    <div className="flex items-center gap-x-3">
                                        <BoxWithInitials source={user.name} />
                                        <span className="font-bold">
                                            {user.name}
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
                                {/*<Button*/}
                                {/*    variant="light"*/}
                                {/*    startContent={<FaSearch />}*/}
                                {/*    endContent={<Kbd keys={['command']}>K</Kbd>}*/}
                                {/*    className="text-default-500"*/}
                                {/*    size="lg"*/}
                                {/*>*/}
                                {/*    Search templates*/}
                                {/*</Button>*/}
                                <Button
                                    as={Link}
                                    size="lg"
                                    href="/browse/official"
                                    startContent={<FaCompass />}
                                    variant="light"
                                    className="gap-2 px-3 text-default-600"
                                >
                                    Browse Kits
                                </Button>

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
                                    <>
                                        <Button
                                            as={Link}
                                            size="lg"
                                            href="/browse/my"
                                            startContent={<FaUser />}
                                            variant="light"
                                            className="gap-2 px-3 text-default-600"
                                        >
                                            My Kits
                                        </Button>

                                        <Button
                                            as={Link}
                                            size="lg"
                                            href="/projects"
                                            startContent={<FaGithubAlt />}
                                            variant="light"
                                            className="gap-2 px-3 text-default-600"
                                        >
                                            My Projects
                                        </Button>
                                        <Button
                                            variant="light"
                                            size="lg"
                                            startContent={<HiSparkles />}
                                            onPress={createKitModal.onPress}
                                            className="gap-2 px-3 text-default-600"
                                        >
                                            Create custom kit
                                        </Button>

                                        <Divider
                                            orientation="vertical"
                                            className="h-6"
                                        />

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
                                                        Manage Github
                                                        integration
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
                                                            router.post(
                                                                '/logout',
                                                            )
                                                        }
                                                    >
                                                        Sign out
                                                    </DropdownItem>
                                                </DropdownSection>
                                            </DropdownMenu>
                                        </Dropdown>
                                    </>
                                )}
                            </div>
                        </div>
                    </div>
                </header>

                <main className="flex-1">{children}</main>

                <Footer />

                <CreateProjectModal
                    kit={selectedKit}
                    onClose={() => onSelectKit(undefined)}
                />

                {user && (
                    <>
                        <CreateKitModal
                            isOpen={createKitModal.show}
                            onClose={createKitModal.onClose}
                        />
                    </>
                )}
            </div>
        </Providers>
    );
}

import { Tab, Tabs, Tooltip } from '@heroui/react';
import { Head, Link, usePage } from '@inertiajs/react';
import { PropsWithChildren } from 'react';

export default function BrowseLayout({ children }: PropsWithChildren) {
    const type = usePage().props.type as string;

    return (
        <>
            <Head>
                <title>{`${type.charAt(0).toUpperCase() + type.slice(1)} Laravel Starter Kits`}</title>
            </Head>
            <div className="mx-auto max-w-7xl px-6 py-8">
                <div className="flex justify-between">
                    <h1 className="mb-4 font-medium capitalize text-default-900">
                        {type} Laravel Starter Kits
                    </h1>
                </div>
                <nav className="sticky top-6 z-20 mb-6 flex w-full justify-center">
                    <Tabs
                        aria-label="Options"
                        classNames={{
                            tabList: 'bg-default-200/50 backdrop-blur-sm p-1.5',
                        }}
                        selectedKey={type}
                    >
                        <Tab
                            key="official"
                            as={Link}
                            href={`/browse/official`}
                            // @ts-expect-error
                            prefetch="mount"
                            title={
                                <Tooltip
                                    offset={16}
                                    closeDelay={0}
                                    content="Official starter kits by Laravel Team"
                                >
                                    Official Kits
                                </Tooltip>
                            }
                        />
                        <Tab
                            key="community"
                            as={Link}
                            href={`/browse/community`}
                            // @ts-expect-error
                            prefetch="mount"
                            title={
                                <Tooltip
                                    offset={16}
                                    closeDelay={0}
                                    content="Public starter kits made by Laravel Start users"
                                >
                                    Community Kits
                                </Tooltip>
                            }
                        />
                        <Tab
                            key="my"
                            as={Link}
                            href={`/browse/my`}
                            // @ts-expect-error
                            prefetch="mount"
                            title={
                                <Tooltip
                                    offset={16}
                                    closeDelay={0}
                                    content="Custom starter kits you've created"
                                >
                                    My Kits
                                </Tooltip>
                            }
                        />
                    </Tabs>
                </nav>

                {children}
            </div>
        </>
    );
}

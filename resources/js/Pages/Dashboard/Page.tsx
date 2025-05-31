import BoxWithInitials from '@/Components/BoxWithInitials';
import AppLayout from '@/Layouts/AppLayout';
import { emptyText } from '@/Pages/Browse/_consts';
import RecentKits from '@/Pages/Dashboard/_components/RecentKits';
import { DashboardProps } from '@/Pages/Dashboard/_types';
import { PageProps } from '@/types';
import {
    Button,
    Table,
    TableBody,
    TableCell,
    TableColumn,
    TableHeader,
    TableRow,
    Tooltip,
    Link as UILink,
} from '@heroui/react';
import { Head, Link } from '@inertiajs/react';
import { BiGitBranch } from 'react-icons/bi';
import { FaClock } from 'react-icons/fa';
import { FaThumbtackSlash } from 'react-icons/fa6';
import ReactTimeAgo from 'react-time-ago';

function Dashboard({
    recentKits,
    recentProjects,
    pinnedKits,
}: PageProps<DashboardProps>) {
    return (
        <div className="mx-auto max-w-7xl px-6 py-8">
            {pinnedKits.length > 0 && (
                <div className="mb-8">
                    <h2 className="mb-4 font-medium text-default-900">
                        Pinned Kits
                    </h2>
                    <div className="grid grid-cols-2 gap-4 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-8">
                        {pinnedKits.map((kit) => (
                            <Tooltip key={kit.id} content={kit.title}>
                                <div className="group relative aspect-square rounded-lg border-2 border-dashed bg-default-50 p-2 transition-all hover:bg-default-100">
                                    <Tooltip content="Unpin kit">
                                        <Button
                                            isIconOnly
                                            size="sm"
                                            variant="light"
                                            className="absolute right-2 top-2 opacity-0 group-hover:opacity-100"
                                            as={Link}
                                            href={`/kits/${kit.id}/pin`}
                                            method="delete"
                                        >
                                            <FaThumbtackSlash
                                                size={20}
                                                className="text-default-600"
                                            />
                                        </Button>
                                    </Tooltip>

                                    <Link
                                        href={`/kits/${kit.slug}`}
                                        className="flex h-full flex-col items-center justify-center gap-2"
                                    >
                                        <BoxWithInitials
                                            className="w-12"
                                            source={kit.title}
                                        />

                                        <div className="line-clamp-1 text-center text-sm font-medium text-default-600">
                                            {kit.title}
                                        </div>
                                    </Link>
                                </div>
                            </Tooltip>
                        ))}
                    </div>
                </div>
            )}

            {recentProjects.length > 0 && (
                <div className="mb-6">
                    <div className="mb-4 flex items-center justify-between">
                        <h2 className="font-medium text-default-900">
                            Recent Projects
                        </h2>

                        <UILink as={Link} color="foreground" href="/projects">
                            See all
                        </UILink>
                    </div>

                    <Table
                        hideHeader
                        aria-label="Example static collection table"
                        classNames={{
                            base: 'bg-default-50',
                            td: 'py-3',
                        }}
                    >
                        <TableHeader>
                            <TableColumn>NAME</TableColumn>
                            <TableColumn>ROLE</TableColumn>
                            <TableColumn>STATUS</TableColumn>
                        </TableHeader>
                        <TableBody>
                            {recentProjects.map((project) => (
                                <TableRow key={project.id}>
                                    <TableCell>
                                        <Link
                                            prefetch="hover"
                                            href={`/projects/${project.id}`}
                                            className="text-sm text-default-600 hover:text-default-900"
                                        >
                                            <BiGitBranch className="mr-2 inline -translate-y-[2px] text-default-500" />
                                            <span>{`${project.repoOwner}/${project.repoName}`}</span>
                                        </Link>
                                    </TableCell>
                                    <TableCell>
                                        <Link
                                            href={`/projects/${project.id}`}
                                            className="text-sm text-default-600 hover:text-default-900"
                                        >
                                            {project.kit.title}
                                        </Link>
                                    </TableCell>
                                    <TableCell>
                                        <FaClock className="mr-2 inline -translate-y-[2px] text-default-400" />
                                        <span className="text-sm text-default-500">
                                            <ReactTimeAgo
                                                date={
                                                    new Date(project.createdAt)
                                                }
                                                timeStyle="round-minute"
                                                locale="en-US"
                                            />
                                        </span>
                                    </TableCell>
                                </TableRow>
                            ))}
                        </TableBody>
                    </Table>
                </div>
            )}

            <div className="flex justify-between">
                <h2 className="mb-4 font-medium text-default-900">
                    Official Laravel Starter Kits
                </h2>
            </div>

            <RecentKits
                kits={recentKits.official}
                seeAllUrl={`/browse/official`}
                emptyText={emptyText.official}
            />

            <h2 className="mb-4 font-medium text-default-900">
                Community Starter Kits
            </h2>

            <RecentKits
                kits={recentKits.community}
                seeAllUrl={`/browse/community`}
                emptyText={emptyText.community}
                className="mb-6"
            />

            <h2 className="mb-4 font-medium text-default-900">Your Kits</h2>

            <RecentKits
                kits={recentKits.my}
                seeAllUrl={`/browse/my`}
                emptyText={emptyText.my}
                className="mb-6"
            />
        </div>
    );
}

// @ts-expect-error
Dashboard.layout = (page) => (
    <AppLayout>
        <Head>
            <title>Dashboard</title>
        </Head>
        {page}
    </AppLayout>
);

export default Dashboard;

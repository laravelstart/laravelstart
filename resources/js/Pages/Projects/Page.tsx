import AppLayout from '@/Layouts/AppLayout';
import { PageProps } from '@/types';
import { Project } from '@/types/resources';
import {
    Button,
    Card,
    Table,
    TableBody,
    TableCell,
    TableColumn,
    TableHeader,
    TableRow,
    Link as UILink,
} from '@heroui/react';
import { Head, Link } from '@inertiajs/react';
import { BiGitBranch, BiGitCommit } from 'react-icons/bi';
import { FaClock, FaCompass } from 'react-icons/fa';
import ReactTimeAgo from 'react-time-ago';

type MyProjectsPageProps = {
    projects: Project[];
};

function MyProjectsPage({ projects }: PageProps<MyProjectsPageProps>) {
    return (
        <div className="mx-auto max-w-7xl px-6 py-8">
            <div className="mb-6 flex items-center justify-between">
                <h1 className="text-2xl font-bold">My Projects</h1>
            </div>

            {projects.length > 0 ? (
                <Card>
                    <Table
                        hideHeader
                        aria-label="Applications table"
                        classNames={{
                            wrapper: 'shadow-none',
                        }}
                        bottomContent={
                            projects.length > 10 && (
                                <div className="flex justify-center">
                                    <UILink
                                        as={Link}
                                        href="#"
                                        color="foreground"
                                        className="text-sm"
                                    >
                                        View all projects
                                    </UILink>
                                </div>
                            )
                        }
                    >
                        <TableHeader>
                            <TableColumn>REPOSITORY</TableColumn>
                            <TableColumn>STARTER KIT</TableColumn>
                            <TableColumn>LAST COMMIT</TableColumn>
                            <TableColumn>CREATED</TableColumn>
                        </TableHeader>
                        <TableBody>
                            {projects.map((project) => (
                                <TableRow key={project.id}>
                                    <TableCell>
                                        <Link
                                            href={`/projects/${project.id}`}
                                            className="flex items-center gap-2 text-sm text-default-600 hover:text-default-900"
                                        >
                                            <BiGitBranch className="text-default-500" />
                                            <span>{`${project.repoOwner}/${project.repoName}`}</span>
                                        </Link>
                                    </TableCell>
                                    <TableCell>
                                        <Link
                                            href={`/kits/${project.kit.slug}`}
                                            className="text-sm text-default-600 hover:text-default-900"
                                        >
                                            {project.kit.title}
                                        </Link>
                                    </TableCell>
                                    <TableCell>
                                        <div className="flex items-center gap-2 text-sm">
                                            <BiGitCommit className="text-default-500" />
                                            <span className="text-default-600">
                                                {project.commit.message.length >
                                                50
                                                    ? `${project.commit.message.slice(0, 50)}...`
                                                    : project.commit.message}
                                            </span>
                                        </div>
                                    </TableCell>
                                    <TableCell>
                                        <div className="flex items-center gap-2 text-sm text-default-500">
                                            <FaClock />
                                            <ReactTimeAgo
                                                date={
                                                    new Date(project.createdAt)
                                                }
                                                timeStyle="twitter"
                                                locale="en-US"
                                            />
                                        </div>
                                    </TableCell>
                                </TableRow>
                            ))}
                        </TableBody>
                    </Table>
                </Card>
            ) : (
                <div className="flex flex-col items-center justify-center gap-4 rounded-xl border-2 border-dashed py-8">
                    <BiGitBranch size={48} className="text-default-300" />
                    <div className="text-center">
                        <h3 className="text-lg font-medium">No projects yet</h3>
                        <p className="text-default-500">
                            Start by creating your first project from a starter
                            kit
                        </p>
                    </div>

                    <Button
                        variant="flat"
                        as={Link}
                        href="/browse/official"
                        className="text-default-600"
                        startContent={<FaCompass size={20} />}
                    >
                        Browse Kits
                    </Button>
                </div>
            )}
        </div>
    );
}

// @ts-expect-error
MyProjectsPage.layout = (page) => (
    <AppLayout>
        <Head>
            <title>Projects</title>
        </Head>
        {page}
    </AppLayout>
);

export default MyProjectsPage;

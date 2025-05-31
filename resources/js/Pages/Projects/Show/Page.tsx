import useSelectKit from '@/hooks/useSelectKit';
import AppLayout from '@/Layouts/AppLayout';
import { PageProps } from '@/types';
import { Project } from '@/types/resources';
import {
    Alert,
    Avatar,
    Button,
    Card,
    CardBody,
    CardHeader,
    Chip,
    Divider,
    Snippet,
} from '@heroui/react';
import { Head, usePage } from '@inertiajs/react';
import { BiGitBranch, BiGitCommit } from 'react-icons/bi';
import { FaGithub } from 'react-icons/fa';
import { HiSparkles } from 'react-icons/hi';
import ReactTimeAgo from 'react-time-ago';

type ShowProjectProps = {
    project: Project;
};

function ShowProject({ project }: PageProps<ShowProjectProps>) {
    const user = usePage().props.auth.user!;
    const { onSelectKit } = useSelectKit();

    return (
        <>
            <Head>
                <title>
                    {`Projects/${project.repoOwner}/${project.repoName}`}
                </title>
            </Head>
            <div className="mx-auto max-w-4xl px-6 py-8">
                <div className="mb-6 flex items-center justify-between">
                    <div className="flex items-center gap-4">
                        <div className="flex aspect-square w-12 items-center justify-center rounded-lg bg-danger-50">
                            <span className="text-xl font-semibold uppercase text-danger">
                                {project.repoName.at(0)}
                            </span>
                        </div>
                        <div>
                            <h1 className="text-2xl font-bold">
                                {project.repoName}
                            </h1>
                            <a
                                href={project.repoUrl}
                                target="_blank"
                                rel="noopener noreferrer"
                                className="text-default-500 hover:text-default-700"
                            >
                                <BiGitBranch className="mr-1 inline" />
                                {project.repoOwner}/{project.repoName}
                            </a>
                        </div>
                    </div>
                    <Button
                        as="a"
                        href={project.repoUrl}
                        target="_blank"
                        color="default"
                        variant="bordered"
                        startContent={<FaGithub />}
                    >
                        Visit on GitHub
                    </Button>
                </div>

                <Alert variant="faded" className="mb-6" icon={<BiGitCommit />}>
                    <div className="flex w-full flex-row justify-between">
                        <div className="flex items-center gap-x-2">
                            <span>{project.commit.message}</span>
                            <Chip
                                as="a"
                                href={`${project.repoUrl}/commit/${project.commit.commit_sha}`}
                                target="_blank"
                                rel="noopener noreferrer"
                                variant="bordered"
                                classNames={{
                                    content: 'text-default-600 font-bold',
                                    base: 'rounded-md',
                                }}
                            >
                                {project.commit.commit_sha.slice(0, 7)}
                            </Chip>
                        </div>

                        <div className="flex items-center gap-x-16">
                            <div className="flex items-center gap-x-2">
                                <Avatar src={user.image} size="sm" />
                                <span>{project.commit.author}</span>
                            </div>

                            <span className="text-sm text-default-600">
                                <ReactTimeAgo
                                    timeStyle="round-minute"
                                    locale="en-US"
                                    date={
                                        new Date(project.commit.created_at.date)
                                    }
                                />
                            </span>
                        </div>
                    </div>
                </Alert>

                <div className="grid gap-6">
                    <Card>
                        <CardHeader>
                            <h2 className="text-lg">
                                Clone Repository locally
                            </h2>
                        </CardHeader>
                        <Divider />
                        <CardBody className="flex flex-col gap-4">
                            <div>
                                <p className="mb-2 text-sm text-default-500">
                                    Clone over HTTPS
                                </p>
                                <Snippet
                                    variant="flat"
                                    className="w-full"
                                    content={`git clone ${project.httpsUrl}`}
                                >
                                    {`git clone ${project.httpsUrl}`}
                                </Snippet>
                            </div>
                            <div>
                                <p className="mb-2 text-sm text-default-500">
                                    Clone over SSH
                                </p>

                                <Snippet
                                    variant="flat"
                                    className="w-full"
                                    content={`git clone ${project.sshUrl}`}
                                >
                                    {`git clone ${project.sshUrl}`}
                                </Snippet>
                            </div>
                        </CardBody>
                    </Card>

                    <Card>
                        <CardHeader className="flex justify-between">
                            <div className="flex items-center gap-3">
                                <div className="flex aspect-square w-12 items-center justify-center rounded-lg bg-danger-50">
                                    <span className="text-xl font-semibold uppercase text-danger">
                                        {project.kit.title.at(0)}
                                    </span>
                                </div>
                                <div className="flex flex-col">
                                    <p className="text-md">
                                        {project.kit.title}
                                    </p>
                                    <a
                                        className="text-small text-default-500"
                                        href={project.kit.repoUrl}
                                        target="_blank"
                                        rel="noopener noreferrer"
                                    >
                                        <BiGitBranch className="mr-1 inline" />
                                        {project.kit.repoOrganisation}/
                                        {project.kit.repoName}
                                    </a>
                                </div>
                            </div>

                            <Button
                                color="primary"
                                variant="bordered"
                                size="lg"
                                startContent={<HiSparkles />}
                                onPress={() => onSelectKit(project.kit)}
                            >
                                Create another project
                            </Button>
                        </CardHeader>
                        <Divider />
                        <CardBody>
                            <p className="mb-2 text-sm text-default-500">
                                Author: <b>{project.kit.repoOrganisation}</b>
                            </p>
                        </CardBody>
                    </Card>
                </div>
            </div>
        </>
    );
}

// @ts-expect-error
ShowProject.layout = (page) => <AppLayout>{page}</AppLayout>;

export default ShowProject;

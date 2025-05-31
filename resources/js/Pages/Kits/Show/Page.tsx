import BoxWithInitials from '@/Components/BoxWithInitials';
import useSelectKit from '@/hooks/useSelectKit';
import AppLayout from '@/Layouts/AppLayout';
import { PageProps } from '@/types';
import { StarterKit } from '@/types/resources';
import {
    Avatar,
    Button,
    Card,
    CardBody,
    CardHeader,
    Chip,
    Divider,
} from '@heroui/react';
import { Head } from '@inertiajs/react';
import { BiGitBranch } from 'react-icons/bi';
import { FaCheck, FaDownload, FaGithubAlt, FaLock } from 'react-icons/fa';
import { HiSparkles } from 'react-icons/hi';
import ReactTimeAgo from 'react-time-ago';

type ShowKitPageProps = {
    kit: StarterKit;
};

function ShowKitPage({ kit }: PageProps<ShowKitPageProps>) {
    const { onSelectKit } = useSelectKit();

    return (
        <>
            <Head>
                <title>{`${kit.title}`}</title>
            </Head>
            <div className="mx-auto max-w-4xl px-6 py-8">
                <div className="mb-6 flex items-center justify-between">
                    <div className="flex items-center gap-4">
                        <BoxWithInitials
                            source={kit.title}
                            className="w-16 text-2xl"
                        />
                        <div>
                            <div className="flex items-center gap-2">
                                <h1 className="text-2xl font-bold">
                                    {kit.title}
                                </h1>
                                {!kit.isPublic && (
                                    <Chip
                                        variant="flat"
                                        color="default"
                                        size="sm"
                                        className="translate-y-[1px]"
                                    >
                                        <FaLock />
                                    </Chip>
                                )}
                            </div>
                            <div className="flex items-center gap-3 text-default-500">
                                <a
                                    href={kit.repoUrl}
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    className="font-bold hover:text-default-700"
                                >
                                    <BiGitBranch className="mr-1 inline" />
                                    {kit.repoOrganisation}/{kit.repoName}
                                </a>
                                <span className="text-sm">•</span>
                                <span className="text-sm font-bold">
                                    Updated{' '}
                                    <ReactTimeAgo
                                        date={new Date(kit.lastUpdatedAt)}
                                        timeStyle="round-minute"
                                    />
                                </span>
                            </div>
                        </div>
                    </div>

                    <div className="flex flex-col items-end gap-2.5 pt-8">
                        <Button
                            color="primary"
                            variant="bordered"
                            size="lg"
                            startContent={<HiSparkles />}
                            onPress={() => onSelectKit(kit)}
                            className="flex-shrink-0"
                        >
                            Use this kit
                        </Button>

                        <span className="text-sm text-default-800">
                            <FaDownload className="mr-1 inline -translate-y-0.5" />
                            {kit.installsCount} installs
                        </span>
                    </div>
                </div>

                <div className="grid gap-6">
                    <Card shadow="none" className="border-1 border-default-200">
                        <CardHeader>
                            <h2 className="text-lg">Author</h2>
                        </CardHeader>
                        <Divider />
                        <CardBody>
                            <div className="flex items-center gap-4">
                                <Avatar
                                    src={kit.user?.image}
                                    icon={
                                        <FaGithubAlt
                                            size={24}
                                            className="text-default-400"
                                        />
                                    }
                                    alt={kit.repoOrganisation}
                                    className="h-12 w-12 rounded-full bg-default-200"
                                />
                                <div>
                                    <p className="text-lg">
                                        {kit.repoOrganisation}{' '}
                                        {kit.repoOrganisation === 'laravel' ||
                                            (kit.repoOrganisation ===
                                                'laravelstart' && (
                                                <FaCheck
                                                    size={16}
                                                    className="ml-1 inline -translate-y-0.5 text-lime-600"
                                                />
                                            ))}
                                    </p>
                                    {kit.user && (
                                        <p className="text-sm text-default-500">
                                            Member since{' '}
                                            <ReactTimeAgo
                                                date={
                                                    new Date(kit.user.createdAt)
                                                }
                                            />
                                        </p>
                                    )}
                                </div>
                            </div>
                        </CardBody>
                    </Card>

                    <Card shadow="none" className="border-1 border-default-200">
                        <CardHeader>
                            <h2 className="text-lg">Dependencies</h2>
                        </CardHeader>
                        <Divider />
                        <CardBody>
                            <div className="grid gap-6">
                                {kit.composerDependencies && (
                                    <div>
                                        <p className="mb-3 text-sm text-default-500">
                                            PHP Dependencies
                                        </p>
                                        <div className="flex flex-wrap gap-2">
                                            {kit.composerDependencies.map(
                                                (dep) => (
                                                    <Chip
                                                        key={dep.package}
                                                        size="lg"
                                                        as="a"
                                                        href={`https://packagist.org/packages/${dep.package}`}
                                                        target="_blank"
                                                        rel="noopener noreferrer"
                                                        variant="solid"
                                                        color="primary"
                                                        className="bg-primary-400"
                                                    >
                                                        {dep.package}{' '}
                                                        {dep.version}
                                                    </Chip>
                                                ),
                                            )}
                                        </div>
                                    </div>
                                )}

                                {kit.nodeDependencies && (
                                    <div>
                                        <p className="mb-3 text-sm text-default-500">
                                            Node Dependencies
                                        </p>
                                        <div className="flex flex-wrap gap-2">
                                            {kit.nodeDependencies.map((dep) => (
                                                <Chip
                                                    key={dep.package}
                                                    as="a"
                                                    size="lg"
                                                    href={`https://www.npmjs.com/package/${dep.package}`}
                                                    target="_blank"
                                                    rel="noopener noreferrer"
                                                    variant="solid"
                                                    color="warning"
                                                    className="bg-warning-200 text-default-800"
                                                >
                                                    {dep.package} {dep.version}
                                                </Chip>
                                            ))}
                                        </div>
                                    </div>
                                )}
                            </div>
                        </CardBody>
                    </Card>
                </div>
            </div>
        </>
    );
}

// @ts-expect-error
ShowKitPage.layout = (page) => <AppLayout>{page}</AppLayout>;

export default ShowKitPage;

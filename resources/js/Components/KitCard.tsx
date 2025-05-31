import BoxWithInitials from '@/Components/BoxWithInitials';
import KitCardTag from '@/Components/KitCardTag';
import useSelectKit from '@/hooks/useSelectKit';
import { StarterKit } from '@/types/resources';
import { Button, Card, CardBody, CardHeader, Tooltip } from '@heroui/react';
import { Link, usePage } from '@inertiajs/react';
import { useState } from 'react';
import { BiGitBranch } from 'react-icons/bi';
import { FaCalendar, FaDownload, FaThumbtack, FaUserAlt } from 'react-icons/fa';
import { HiSparkles } from 'react-icons/hi';
import ReactTimeAgo from 'react-time-ago';

export default function KitCard({ kit }: { kit: StarterKit }) {
    const user = usePage().props.auth.user;
    const { onSelectKit } = useSelectKit();
    const [pinned, setPinned] = useState(false);

    return (
        <Card
            key={kit.id}
            shadow="none"
            className="group border-1 border-default-200"
        >
            <CardHeader className="justify-between">
                <div className="flex items-start gap-3">
                    <Link href={`/kits/${kit.slug}`}>
                        <BoxWithInitials
                            className="w-12 text-2xl"
                            source={kit.title}
                        />
                    </Link>

                    <div className="flex flex-col">
                        <Link
                            href={`/kits/${kit.slug}`}
                            className="line-clamp-1 text-lg"
                        >
                            {kit.title}
                        </Link>
                        <a
                            className="text-sm text-default-500"
                            href={kit.repoUrl}
                            target="_blank"
                            rel="noopener noreferrer"
                        >
                            <BiGitBranch className="mr-1 inline" />
                            {kit.repoOrganisation}/{kit.repoName}
                        </a>
                    </div>
                </div>

                <div className="flex gap-2">
                    <Button
                        color="primary"
                        variant="bordered"
                        startContent={<HiSparkles />}
                        onPress={() => onSelectKit(kit)}
                        className="flex-1 flex-shrink-0"
                    >
                        Use this kit
                    </Button>

                    {user && (
                        <Tooltip content="Pin kit to dashboard">
                            <Button
                                isDisabled={pinned}
                                as={Link}
                                href={`/kits/${kit.id}/pin`}
                                method="post"
                                preserveScroll={true}
                                onStart={() => setPinned(true)}
                                startContent={
                                    <FaThumbtack className="text-default-600" />
                                }
                                variant="light"
                                isIconOnly
                            />
                        </Tooltip>
                    )}
                </div>
            </CardHeader>

            <CardBody className="px-4 py-6">
                <div className="mb-6 flex flex-wrap gap-4">
                    <Tooltip content="Kit author">
                        <div className="flex items-center gap-1 text-sm text-default-500">
                            <FaUserAlt /> <b>{kit.repoOrganisation}</b>
                        </div>
                    </Tooltip>

                    <Tooltip content="Installs count">
                        <div className="flex items-center gap-1 text-sm text-default-500">
                            <FaDownload /> <b>{kit.installsCount}</b>
                        </div>
                    </Tooltip>

                    <Tooltip content="Last updated">
                        <div className="flex items-center gap-1 text-sm text-default-500">
                            <FaCalendar />{' '}
                            <ReactTimeAgo
                                className="font-bold"
                                date={new Date(kit.lastUpdatedAt)}
                            />
                        </div>
                    </Tooltip>
                </div>

                <div className="flex max-w-sm flex-wrap gap-2">
                    {kit.tags.map((tag) => (
                        <KitCardTag tag={tag} key={kit.id} />
                    ))}
                </div>
            </CardBody>
        </Card>
    );
}

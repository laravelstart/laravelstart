import BoxWithInitials from '@/Components/BoxWithInitials';
import KitCardTag from '@/Components/KitCardTag';
import useSelectKit from '@/hooks/useSelectKit';
import { StarterKit } from '@/types/resources';
import {
    Button,
    Card,
    CardBody,
    CardHeader,
    Divider,
    Tooltip,
} from '@heroui/react';
import { Link } from '@inertiajs/react';
import { useState } from 'react';
import { BiGitBranch } from 'react-icons/bi';
import { FaCalendar, FaDownload, FaThumbtack, FaUserAlt } from 'react-icons/fa';
import { HiSparkles } from 'react-icons/hi';
import ReactTimeAgo from 'react-time-ago';

export default function KitCardCompact({ kit }: { kit: StarterKit }) {
    const { onSelectKit } = useSelectKit();
    const [pinned, setPinned] = useState(false);

    return (
        <Card key={kit.id} className="group" shadow="sm">
            <CardHeader className="flex items-start gap-3">
                <Link href={`/kits/${kit.slug}`}>
                    <BoxWithInitials
                        className="w-12 text-2xl"
                        source={kit.title}
                    />
                </Link>

                <div className="flex flex-col">
                    <Link
                        href={`/kits/${kit.slug}`}
                        className="text-md line-clamp-1 break-all"
                    >
                        {kit.title}
                    </Link>
                    <a
                        className="line-clamp-1 text-small text-default-500"
                        href={kit.repoUrl}
                        target="_blank"
                        rel="noopener noreferrer"
                    >
                        <BiGitBranch className="mr-1 inline" />
                        {kit.repoOrganisation}/{kit.repoName}
                    </a>
                </div>
            </CardHeader>
            <Divider />
            <CardBody className="p-4">
                <div className="mb-4 flex flex-wrap gap-4">
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

                <div className="mb-6 flex flex-wrap gap-2">
                    {kit.tags.map((tag) => (
                        <KitCardTag tag={tag} key={kit.id} />
                    ))}
                </div>

                <div className="mt-auto">
                    <div className="flex w-full gap-2 opacity-0 transition-opacity group-hover:opacity-100">
                        <Button
                            color="primary"
                            variant="bordered"
                            startContent={
                                <HiSparkles className="flex-shrink-0" />
                            }
                            onPress={() => onSelectKit(kit)}
                            className="flex-1"
                        >
                            <span className="line-clamp-1 overflow-ellipsis break-all">
                                Use this kit
                            </span>
                        </Button>

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
                    </div>
                </div>
            </CardBody>
        </Card>
    );
}

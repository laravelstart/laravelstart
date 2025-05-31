import KitCardCompact from '@/Components/KitCardCompact';
import useCreateKitModal from '@/hooks/useCreateKitModal';
import { StarterKit } from '@/types/resources';
import { Button, Card, CardBody } from '@heroui/react';
import { Link } from '@inertiajs/react';
import { FaArrowCircleRight } from 'react-icons/fa';
import { HiSparkles } from 'react-icons/hi';

export default function RecentKits({
    kits,
    emptyText,
    className,
    seeAllUrl,
}: {
    kits: StarterKit[];
    emptyText: string;
    className?: string;
    seeAllUrl: string;
}) {
    const createKitModal = useCreateKitModal();

    return (
        <div className={className}>
            {kits.length > 0 ? (
                <div className="mb-6 grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-4">
                    {kits.map((kit) => (
                        <KitCardCompact kit={kit} key={kit.id} />
                    ))}
                    {kits.length >= 3 && (
                        <Card
                            as={Link}
                            href={seeAllUrl}
                            prefetch="hover"
                            shadow="sm"
                        >
                            <CardBody className="items-center justify-center gap-y-4 text-xl text-default-600/60 hover:text-default-600/80">
                                <FaArrowCircleRight size={36} />
                                See all
                            </CardBody>
                        </Card>
                    )}
                </div>
            ) : (
                <div className="flex flex-col items-center justify-center gap-4 rounded-xl border-2 border-dashed py-8">
                    <div className="text-default-400">{emptyText}</div>
                    <Button
                        variant="flat"
                        onPress={createKitModal.onPress}
                        className="text-default-600"
                        startContent={<HiSparkles size={20} />}
                    >
                        Create Kit
                    </Button>
                </div>
            )}
        </div>
    );
}

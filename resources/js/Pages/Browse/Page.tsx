import KitCard from '@/Components/KitCard';
import useCreateKitModal from '@/hooks/useCreateKitModal';
import AppLayout from '@/Layouts/AppLayout';
import { emptyText } from '@/Pages/Browse/_consts';
import BrowseLayout from '@/Pages/Browse/Layout';
import { PageProps } from '@/types';
import { StarterKit } from '@/types/resources';
import { Button, Spinner } from '@heroui/react';
import { WhenVisible } from '@inertiajs/react';
import { HiSparkles } from 'react-icons/hi';

type BrowsePageProps = {
    type: 'official' | 'community' | 'my';
    kits: StarterKit[];
    meta: {
        currentPage: number;
        isLastPage: number;
        total: number;
    };
};

function BrowsePage({ kits, type, meta }: PageProps<BrowsePageProps>) {
    const createKitModal = useCreateKitModal();

    if (kits.length < 1) {
        return (
            <div className="flex flex-col items-center justify-center gap-4 rounded-xl border-2 border-dashed py-8">
                <div className="text-default-400">
                    {emptyText[type] ?? 'No kits available'}
                </div>
                <Button
                    variant="flat"
                    className="text-default-600"
                    startContent={<HiSparkles size={20} />}
                    onPress={createKitModal.onPress}
                >
                    Create Kit
                </Button>
            </div>
        );
    }

    return (
        <>
            <div className="flex flex-col gap-8">
                {kits.map((kit) => (
                    <>
                        <KitCard kit={kit} key={kit.id} />
                        {/*{index < kits.length - 1 && <Divider />}*/}
                    </>
                ))}
            </div>

            {/* Intersection Observer Target */}
            {!meta.isLastPage && (
                <WhenVisible
                    always
                    buffer={200}
                    params={{
                        data: { page: meta.currentPage + 1 },
                        only: ['kits', 'meta'],
                        preserveUrl: true,
                    }}
                    fallback={<Spinner />}
                >
                    <Spinner />
                </WhenVisible>
            )}
        </>
    );
}

// @ts-expect-error
BrowsePage.layout = (page) => (
    <AppLayout>
        <BrowseLayout>{page}</BrowseLayout>
    </AppLayout>
);

export default BrowsePage;

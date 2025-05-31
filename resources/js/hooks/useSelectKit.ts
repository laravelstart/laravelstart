import { StarterKit } from '@/types/resources';
import { router, usePage } from '@inertiajs/react';
import { atom, useAtom } from 'jotai';
import { useCallback } from 'react';

const selectedKitAtom = atom<StarterKit | undefined>();

export default function useSelectKit() {
    const user = usePage().props.auth.user;
    const [selectedKit, setSelectedKit] = useAtom(selectedKitAtom);

    const onSelectKit = useCallback(
        (kit: StarterKit | undefined) => {
            if (!user) {
                router.visit('/login');
                return;
            }

            setSelectedKit(kit);
        },
        [setSelectedKit, user],
    );

    return { selectedKit, onSelectKit };
}

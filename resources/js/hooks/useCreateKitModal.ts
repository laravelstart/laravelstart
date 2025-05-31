import { atom, useAtom } from 'jotai';
import { useCallback } from 'react';

const modalState = atom<boolean>(false);

export default function useCreateKitModal() {
    const [show, setShow] = useAtom(modalState);

    const onPress = useCallback(() => setShow(true), [setShow]);
    const onClose = useCallback(() => setShow(false), [setShow]);

    return { show, onPress, onClose };
}

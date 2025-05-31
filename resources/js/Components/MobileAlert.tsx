import { Alert } from '@heroui/react';
import { FaExclamationTriangle } from 'react-icons/fa';
import { twMerge } from 'tailwind-merge';

export default function MobileAlert({ className }: { className?: string }) {
    return (
        <Alert
            title="Warning!"
            classNames={{
                base: twMerge(
                    'rounded-none bg-opacity-80 backdrop-blur-xl',
                    className,
                ),
                title: 'text-lg font-bold',
            }}
            color="warning"
            icon={<FaExclamationTriangle />}
        >
            This app is not optimized for mobile devices and implies only
            desktop experience!
        </Alert>
    );
}

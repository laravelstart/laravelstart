import { HeroUIProvider } from '@heroui/react';
import { ToastProvider, addToast } from '@heroui/toast';
import { router } from '@inertiajs/react';
import TimeAgo from 'javascript-time-ago';
import en from 'javascript-time-ago/locale/en';
import { PropsWithChildren } from 'react';

TimeAgo.addLocale(en);

router.on('error', (error) => {
    const errorMessages = Object.values(error.detail.errors);

    errorMessages.forEach((m) =>
        addToast({
            title: 'Ooops!',
            description: m,
            variant: 'solid',
            color: 'danger',
            icon: <span>☠️</span>,
            classNames: {
                icon: 'text-2xl',
                title: 'text-xl font-bold',
                description: 'text-lg text-danger-800',
            },
        }),
    );
});

router.on('success', (event) => {
    const toastMessage = event.detail.page.props.toast;

    if (!toastMessage) {
        return;
    }

    addToast({
        title: 'Boom!',
        description: toastMessage,
        variant: 'bordered',
        color: 'success',
        icon: <span>🎉</span>,
        classNames: {
            icon: 'text-2xl',
            title: 'text-xl font-bold',
            description: 'text-lg text-success-800',
        },
        shouldShowTimeoutProgress: true,
    });
});

export default function Providers({ children }: PropsWithChildren) {
    return (
        <HeroUIProvider>
            {children}

            <ToastProvider placement="bottom-center" />
        </HeroUIProvider>
    );
}

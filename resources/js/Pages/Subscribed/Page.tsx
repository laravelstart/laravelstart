import AppLayout from '@/Layouts/AppLayout';
import { Kbd, Spinner } from '@heroui/react';
import { Head, usePoll } from '@inertiajs/react';
import { useEffect, useState } from 'react';

function Subscribed() {
    usePoll(2_000);

    const [showHint, setShowHint] = useState(false);

    useEffect(() => {
        const timer = setTimeout(() => {
            setShowHint(true);
        }, 5000);

        return () => clearTimeout(timer);
    }, []);

    return (
        <div className="relative flex h-[calc(100vh-65px)] flex-col justify-center">
            <div className="flex items-center justify-center gap-8">
                <Spinner size="lg" color="primary" variant="gradient" />

                <div>
                    <h1 className="mb-2 text-4xl">Please hang on!</h1>
                    <h2 className="text-xl text-default-600">
                        We're verifying your payment
                    </h2>
                </div>
            </div>

            {showHint && (
                <div className="absolute bottom-12 left-[50%] -translate-x-[50%]">
                    <h3 className="text-lg text-gray-600">
                        Nothing happens? Try <Kbd keys="command">R</Kbd>
                    </h3>
                </div>
            )}
        </div>
    );
}

// @ts-expect-error
Subscribed.layout = (page) => (
    <AppLayout>
        <Head>
            <title>We're verifying your payment</title>
        </Head>
        {page}
    </AppLayout>
);

export default Subscribed;

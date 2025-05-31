import { KitTag } from '@/types/resources';
import { Tooltip } from '@heroui/react';
import { useMemo } from 'react';
import { twMerge } from 'tailwind-merge';

export default function KitCardTag({ tag }: { tag: KitTag }) {
    const isLaravel11 = useMemo(() => {
        return (
            tag.package === 'laravel/framework' && tag.version.startsWith('^11')
        );
    }, [tag.package, tag.version]);

    const isLaravel12 = useMemo(() => {
        return (
            tag.package === 'laravel/framework' && tag.version.startsWith('^12')
        );
    }, [tag.package, tag.version]);

    const isFilament = useMemo(() => {
        return tag.package === 'filament/filament';
    }, [tag.package]);

    const isInertia2 = useMemo(() => {
        return (
            tag.package === 'inertiajs/inertia-laravel' &&
            tag.version.startsWith('^2.0')
        );
    }, [tag.package, tag.version]);

    const label = useMemo(() => {
        if (isLaravel11) {
            return 'Laravel 11';
        }

        if (isLaravel12) {
            return 'Laravel 12';
        }

        if (isInertia2) {
            return 'Inertia 2.0';
        }

        return tag.label;
    }, [isInertia2, isLaravel11, isLaravel12, tag.label]);

    return (
        <Tooltip key={tag.package} content={`${tag.package}: ${tag.version}`}>
            <span
                key={tag.package}
                className={twMerge(
                    'rounded-md border border-default-500 bg-white px-2 py-1 text-sm text-default-700',
                    isLaravel12 &&
                        'border-primary bg-gradient-to-bl from-primary-200/75 to-white font-bold text-primary',
                    isInertia2 &&
                        'border-indigo-600 bg-gradient-to-bl from-indigo-200 to-indigo-600 font-bold text-white',
                    isFilament &&
                        'border-filament-200 from-filament-200 to-filament-600 text-filament-50 bg-gradient-to-bl font-bold',
                )}
            >
                {label}
            </span>
        </Tooltip>
    );
}

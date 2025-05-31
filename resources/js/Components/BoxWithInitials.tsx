import { twMerge } from 'tailwind-merge';

const getInitial = (text: string): string => {
    const normalized = text
        .replace(/laravel/gi, '') // Remove 'Laravel' (case-insensitive)
        .replace(/[^a-zA-Z]/g, '') // Remove special characters
        .trim();
    return normalized.at(0) || '';
};

const getColorClasses = (letter: string): { bg: string; text: string } => {
    const letterIndex = (letter.toLowerCase().charCodeAt(0) - 97) % 6;

    switch (letterIndex) {
        case 0:
            return { bg: 'bg-folly-100', text: 'text-folly-500' };
        case 1:
            return { bg: 'bg-delft-blue-100', text: 'text-delft-blue-500' };
        case 2:
            return { bg: 'bg-alice-blue-300', text: 'text-alice-blue-800' };
        case 3:
            return {
                bg: 'bg-tyrian-purple-100',
                text: 'text-tyrian-purple-500',
            };
        case 4:
            return {
                bg: 'bg-columbia-blue-300',
                text: 'text-columbia-blue-800',
            };
        case 5:
            return { bg: 'bg-blush-200', text: 'text-blush-600' };
        default:
            return { bg: 'bg-folly-100', text: 'text-folly-500' };
    }
};

export default function BoxWithInitials({
    source,
    className,
}: {
    source: string;
    className?: string;
}) {
    const initial = getInitial(source);
    const { bg, text } = getColorClasses(initial);

    return (
        <div
            className={twMerge(
                'flex aspect-square w-9 items-center justify-center rounded-lg text-sm',
                bg,
                className,
            )}
        >
            <span className={twMerge('font-semibold uppercase', text)}>
                {initial}
            </span>
        </div>
    );
}

import MinimalAppLayout from '@/Layouts/MinimalAppLayout';
import { motion } from 'framer-motion';
import { useState } from 'react';

interface Step {
    title: string;
    options: { value: string; label: string }[];
}

function WizardPage() {
    const [currentStep, setCurrentStep] = useState(0);
    const [selections, setSelections] = useState({
        starterKit: '',
        auth: '',
        database: '',
        tests: '',
        development: false,
    });

    const steps: Step[] = [
        {
            title: 'Choose Starter Kit',
            options: [
                { value: 'none', label: 'None' },
                { value: 'livewire', label: 'Livewire' },
                { value: 'react', label: 'React' },
                { value: 'vue', label: 'Vue' },
                { value: 'custom', label: 'Custom' },
            ],
        },
        {
            title: 'Authentication',
            options: [
                { value: 'workos', label: 'WorkOS' },
                { value: 'default', label: 'Default Laravel Auth' },
            ],
        },
        {
            title: 'Database',
            options: [
                { value: 'sqlite', label: 'SQLite' },
                { value: 'mysql', label: 'MySQL' },
                { value: 'postgres', label: 'PostgreSQL' },
            ],
        },
        {
            title: 'Testing Framework',
            options: [
                { value: 'pest', label: 'Pest' },
                { value: 'phpunit', label: 'PHPUnit' },
            ],
        },
        {
            title: 'Development Release',
            options: [
                { value: 'yes', label: 'Yes' },
                { value: 'no', label: 'No' },
            ],
        },
    ];

    const handleOptionSelect = (value: string) => {
        const key = Object.keys(selections)[
            currentStep
        ] as keyof typeof selections;
        setSelections((prev) => ({
            ...prev,
            [key]: key === 'development' ? value === 'yes' : value,
        }));
        if (currentStep < steps.length - 1) {
            setCurrentStep((prev) => prev + 1);
        }
    };

    const progress = ((currentStep + 1) / steps.length) * 100;

    return (
        <div className="mx-auto max-w-4xl p-8">
            <div className="mb-8">
                <div className="relative pt-1">
                    <div className="mb-2 flex items-center justify-between">
                        <div>
                            <span className="inline-block rounded-full bg-indigo-200 px-2 py-1 text-xs font-semibold uppercase text-indigo-600">
                                Progress
                            </span>
                        </div>
                        <div className="text-right">
                            <span className="inline-block text-xs font-semibold text-indigo-600">
                                {Math.round(progress)}%
                            </span>
                        </div>
                    </div>
                    <div className="mb-4 flex h-2 overflow-hidden rounded bg-indigo-200 text-xs">
                        <motion.div
                            initial={{ width: 0 }}
                            animate={{ width: `${progress}%` }}
                            transition={{ duration: 0.5 }}
                            className="flex flex-col justify-center whitespace-nowrap bg-indigo-500 text-center text-white shadow-none"
                        />
                    </div>
                </div>
            </div>

            <div className="rounded-lg bg-white p-6 shadow-xl">
                <h2 className="mb-6 text-2xl font-bold">
                    {steps[currentStep].title}
                </h2>
                <div className="grid gap-4">
                    {steps[currentStep].options.map((option) => (
                        <button
                            key={option.value}
                            onClick={() => handleOptionSelect(option.value)}
                            className="rounded-lg border-2 p-4 transition-all duration-200 hover:border-indigo-500 hover:bg-indigo-50"
                        >
                            {option.label}
                        </button>
                    ))}
                </div>

                <div className="mt-8 flex justify-between">
                    <button
                        onClick={() =>
                            setCurrentStep((prev) => Math.max(0, prev - 1))
                        }
                        disabled={currentStep === 0}
                        className="rounded-lg bg-gray-200 px-4 py-2 disabled:opacity-50"
                    >
                        Previous
                    </button>
                    {currentStep === steps.length - 1 && (
                        <button
                            onClick={() => console.log(selections)}
                            className="rounded-lg bg-indigo-600 px-4 py-2 text-white hover:bg-indigo-700"
                        >
                            Create Project
                        </button>
                    )}
                </div>
            </div>
        </div>
    );
}

// @ts-expect-error
WizardPage.layout = (page) => <MinimalAppLayout>{page}</MinimalAppLayout>;

export default WizardPage;

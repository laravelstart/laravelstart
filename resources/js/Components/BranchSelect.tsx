import { PageProps } from '@/types';
import { Autocomplete, AutocompleteItem } from '@heroui/react';
import { usePage } from '@inertiajs/react';
import { useMemo } from 'react';
import { Controller, useFormContext } from 'react-hook-form';
import { BiGitBranch } from 'react-icons/bi';

export default function BranchSelect({
    disabled = false,
}: {
    disabled?: boolean;
}) {
    const form = useFormContext<{ branchName: string }>();
    const { branches } = usePage<PageProps>().props;

    const options = useMemo(() => {
        return (branches || []).map((branch) => ({
            key: branch,
            label: branch,
        }));
    }, [branches]);

    return (
        <Controller
            control={form.control}
            name="branchName"
            render={({ field: { onChange, onBlur, value } }) => (
                <Autocomplete
                    selectedKey={value}
                    className="max-w-xs"
                    label={
                        <span className="text-sm !text-default-600">
                            Source Branch
                        </span>
                    }
                    labelPlacement="outside"
                    errorMessage={form.formState.errors.branchName?.message}
                    isInvalid={!!form.formState.errors.branchName}
                    items={options}
                    onSelectionChange={(value) =>
                        onChange({ target: { value } })
                    }
                    onBlur={onBlur}
                    placeholder="branch-name"
                    isDisabled={disabled}
                >
                    {(item) => (
                        <AutocompleteItem
                            key={item.key}
                            startContent={<BiGitBranch />}
                        >
                            {item.label}
                        </AutocompleteItem>
                    )}
                </Autocomplete>
            )}
        />
    );
}

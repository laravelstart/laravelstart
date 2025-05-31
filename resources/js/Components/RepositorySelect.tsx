import { PageProps } from '@/types';
import { Autocomplete, AutocompleteItem } from '@heroui/react';
import { usePage } from '@inertiajs/react';
import { useMemo } from 'react';
import { Controller, useFormContext } from 'react-hook-form';

export default function RepositorySelect({
    disabled = false,
}: {
    disabled?: boolean;
}) {
    const form = useFormContext<{ repositoryName: string }>();
    const { repositories } = usePage<PageProps>().props;

    const repositoriesOptions = useMemo(() => {
        return (repositories || []).map((repository) => ({
            key: repository.name,
            label: repository.name,
        }));
    }, [repositories]);

    return (
        <Controller
            control={form.control}
            name="repositoryName"
            render={({ field: { onChange, onBlur, value } }) => (
                <Autocomplete
                    selectedKey={value}
                    className="max-w-xs"
                    label={
                        <span className="text-sm !text-default-600">
                            Source Repository
                        </span>
                    }
                    labelPlacement="outside"
                    errorMessage={form.formState.errors.repositoryName?.message}
                    isInvalid={!!form.formState.errors.repositoryName}
                    items={repositoriesOptions}
                    onSelectionChange={(value) =>
                        onChange({ target: { value } })
                    }
                    onBlur={onBlur}
                    placeholder="supa-cool-kit"
                    isDisabled={disabled}
                >
                    {(item) => (
                        <AutocompleteItem key={item.key}>
                            {item.label}
                        </AutocompleteItem>
                    )}
                </Autocomplete>
            )}
        />
    );
}

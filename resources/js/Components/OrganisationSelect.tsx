import { PageProps } from '@/types';
import { Autocomplete, AutocompleteItem, Avatar } from '@heroui/react';
import { usePage } from '@inertiajs/react';
import { useMemo } from 'react';
import { Controller, useFormContext } from 'react-hook-form';

export default function OrganisationSelect() {
    const form = useFormContext<{ organisation: string }>();
    const user = usePage().props.auth.user!;
    const { organisations } = usePage<PageProps>().props;

    const organisationOptions = useMemo(() => {
        return [
            {
                key: 'owner',
                label: user.name,
                description: 'No organisation',
                image: user.image,
            },
            ...(organisations || []).map((organisation) => ({
                key: organisation.login,
                label: organisation.login,
                description: null,
                image: organisation.avatar_url,
            })),
        ];
    }, [user, organisations]);

    return (
        <Controller
            control={form.control}
            name="organisation"
            render={({ field: { onChange, onBlur, value } }) => (
                <Autocomplete
                    selectedKey={value}
                    className="max-w-xs"
                    label={
                        <span className="text-sm !text-default-600">
                            Organisation
                        </span>
                    }
                    labelPlacement="outside"
                    errorMessage={form.formState.errors.organisation?.message}
                    isInvalid={!!form.formState.errors.organisation}
                    items={organisationOptions}
                    onSelectionChange={(value) =>
                        onChange({ target: { value } })
                    }
                    onBlur={onBlur}
                    placeholder="my-org"
                >
                    {(item) => (
                        <AutocompleteItem
                            key={item.key}
                            startContent={
                                item.image ? (
                                    <Avatar
                                        showFallback
                                        alt="Argentina"
                                        className="h-6 w-6"
                                        src={user.image}
                                    />
                                ) : null
                            }
                            textValue={item.label}
                        >
                            <p>{item.label}</p>
                            {item.description && (
                                <p className="text-xs text-default-400">
                                    {item.description}
                                </p>
                            )}
                        </AutocompleteItem>
                    )}
                </Autocomplete>
            )}
        />
    );
}

import React, { HTMLAttributes, SyntheticEvent } from 'react';
import { useFormContext, useWatch } from 'react-hook-form';
import {
  Autocomplete as MuiAutocomplete,
  AutocompleteGetTagProps,
  AutocompleteRenderInputParams,
  Avatar,
  Box,
  Chip,
  TextField,
} from '@mui/material';
import { Loadable } from '../../../../../../common/utils/loadable';
import { UserType } from '../../../../../../common/features/user/get';
import { CommentFormType } from '../../../../hooks/form/useCommentForm';
import { ValidationMessage } from '../../../form/ValidationMessage';

type OptionProps = UserType & { props: HTMLAttributes<HTMLLIElement> };
const Option: React.FC<OptionProps> = ({ name, icon, props }) => (
  <Box component="li" {...props}>
    <Avatar alt={name} src={icon} />
    {name}
  </Box>
);

type InputProps = { params: AutocompleteRenderInputParams };
const Input: React.FC<InputProps> = ({ params }) => (
  <TextField variant="outlined" placeholder="推薦ユーザーを選択" {...params} />
);

type TagsProps = { value: UserType[]; getTagProps: AutocompleteGetTagProps };
const Tags: React.FC<TagsProps> = ({ value, getTagProps }) => (
  <>
    {value.map(({ icon, name }, index) => (
      <Chip
        avatar={<Avatar src={icon} alt={name} />}
        variant="outlined"
        label={name}
        size="small"
        {...getTagProps({ index })}
      />
    ))}
  </>
);

type AutoCompleteProps = { loadable: Loadable<UserType[]> };
export const Autocomplete: React.FC<AutoCompleteProps> = ({ loadable }) => {
  const users = loadable.getData();
  const { setValue, control } = useFormContext<CommentFormType>();
  const nomineeIds = useWatch({ control, name: 'nomineeIds' });

  const onChangeHandler: (event: SyntheticEvent, value: UserType[]) => void = (_, value) => {
    setValue(
      'nomineeIds',
      value.map((user) => user.id)
    );
  };

  return (
    <>
      <MuiAutocomplete
        multiple
        options={users}
        noOptionsText="Not Found"
        limitTags={5}
        onChange={onChangeHandler}
        getOptionLabel={({ name }) => name}
        getOptionDisabled={({ id }) => nomineeIds.includes(id)}
        renderOption={(props, user) => <Option key={user.id} props={props} {...user} />}
        renderInput={(params) => <Input params={params} />}
        renderTags={(value, getTagProps) => <Tags value={value} getTagProps={getTagProps} />}
      />
      <ValidationMessage<CommentFormType> name="nomineeIds" />
    </>
  );
};

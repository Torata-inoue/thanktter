import React from 'react';
import { TextField } from '@mui/material';
import { useFormContext } from 'react-hook-form';
import { CommentFormType } from '../../../../hooks/form/useCommentForm';
import { ValidationMessage } from '../../../form/ValidationMessage';

export const TextInput: React.FC = () => {
  const { register } = useFormContext<CommentFormType>();
  return (
    <>
      <TextField fullWidth multiline rows={4} placeholder="コメントを入力" {...register('text')} />
      <ValidationMessage<CommentFormType> name="text" />
    </>
  );
};

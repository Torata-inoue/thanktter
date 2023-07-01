import React from 'react';
import { Button, TextField } from '@mui/material';
import { Send } from '@mui/icons-material';
import { FormProvider, SubmitHandler } from 'react-hook-form';
import { ReplyFormType, useReplyForm } from '../../../../../../hooks/form/useReplyForm';
import { Form } from '../../../../../form/Form';
import { ValidationMessage } from '../../../../../form/ValidationMessage';
import { useSetComment } from '../../../../../../states/atoms/comment';
import { postReplyApi } from '../../../../../../features/comment/post';
import { handleApiError } from '../../../../../../../../common/utils/api';

type ReplyFormProps = { commentId: number };
const Component: React.FC<ReplyFormProps> = ({ commentId }) => {
  const methods = useReplyForm(commentId);
  const setComment = useSetComment(commentId);

  const onSubmit: SubmitHandler<ReplyFormType> = (data) => {
    postReplyApi(data)
      .then((res) => setComment(res))
      .catch(handleApiError);
  };

  return (
    <FormProvider {...methods}>
      <Form onSubmit={onSubmit}>
        <TextField fullWidth multiline placeholder="返信を入力" {...methods.register('text')} />
        <ValidationMessage<ReplyFormType> name="text" />
        <Button type="submit" variant="contained" endIcon={<Send />}>
          送信する
        </Button>
      </Form>
    </FormProvider>
  );
};

export const ReplyForm = React.memo(Component);

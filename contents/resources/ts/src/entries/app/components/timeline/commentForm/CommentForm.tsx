import React from 'react';
import { FormProvider, SubmitHandler } from 'react-hook-form';
import { Button, Card, CardContent } from '@mui/material';
import { Send } from '@mui/icons-material';
import { SelectUser } from './selectUser/SelectUser';
import { CommentFormType, useCommentForm } from '../../../hooks/form/useCommentForm';
import { TextInput } from './textInput/TextInput';
import { postCommentApi } from '../../../features/comment/post';
import { handleApiError } from '../../../../../common/utils/api';
import { ImageUploader } from './image/ImageUploader';
import { Form } from '../../../../../common/components/form/Form';
import { useAddComment } from '../../../states/atoms/comment';

export const CommentForm: React.FC = () => {
  const methods = useCommentForm();
  const addComment = useAddComment();

  const onSubmitHandler: SubmitHandler<CommentFormType> = (data) => {
    const formData = new FormData();
    data.images.map((image) => formData.append('images[]', image));
    data.nomineeIds.map((nomineeId) => formData.append('nomineeIds[]', nomineeId.toString()));
    formData.append('text', data.text);

    postCommentApi(formData)
      .then((res) => {
        addComment(res);
        methods.reset();
      })
      .catch(handleApiError);
  };

  return (
    <Card>
      <CardContent>
        <FormProvider {...methods}>
          <Form<CommentFormType> onSubmit={onSubmitHandler}>
            <SelectUser />
            <ImageUploader>
              <TextInput />
            </ImageUploader>
            <Button type="submit" variant="contained" endIcon={<Send />}>
              送信する
            </Button>
          </Form>
        </FormProvider>
      </CardContent>
    </Card>
  );
};

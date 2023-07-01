import React from 'react';
import { FormProvider, SubmitHandler } from 'react-hook-form';
import { ReactionFormType, useReactionForm } from '../../../../../hooks/form/useReactionForm';
import { postReaction } from '../../../../../features/reaction/post';
import { handleApiError } from '../../../../../../../common/utils/api';
import { useAuth, useSetAuth } from '../../../../../../../common/states/atoms/auth';
import { useSetComment } from '../../../../../states/atoms/comment';
import { Form } from '../../../../../../../common/components/form/Form';

type ReactionFormProps = { children: React.ReactNode; userId: number; commentId: number };
export const ReactionForm: React.FC<ReactionFormProps> = ({ children, userId, commentId }) => {
  const methods = useReactionForm(userId, commentId);
  const auth = useAuth();
  const setAuth = useSetAuth();
  const setComment = useSetComment(commentId);

  const onSubmit: SubmitHandler<ReactionFormType> = (data) => {
    if (auth.stamina === 0) {
      alert('スタミナが足りません');
      return;
    }
    postReaction(data)
      .then((res) => {
        setAuth(res.auth);
        setComment(res.comment);
      })
      .catch(handleApiError);
  };

  return (
    <FormProvider {...methods}>
      <Form<ReactionFormType> onSubmit={onSubmit}>{children}</Form>
    </FormProvider>
  );
};

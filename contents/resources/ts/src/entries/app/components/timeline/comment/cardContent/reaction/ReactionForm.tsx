import React from 'react';
import { FormProvider, SubmitHandler } from 'react-hook-form';
import { ReactionFormType, useReactionForm } from '../../../../../hooks/form/useReactionForm';
import { Form } from '../../../../form/Form';

type ReactionFormProps = { children: React.ReactNode; userId: number };
export const ReactionForm: React.FC<ReactionFormProps> = ({ children, userId }) => {
  const methods = useReactionForm(userId);

  const onSubmit: SubmitHandler<ReactionFormType> = (data) => {
    console.log(data);
  };

  return (
    <FormProvider {...methods}>
      <Form<ReactionFormType> onSubmit={onSubmit}>{children}</Form>
    </FormProvider>
  );
};

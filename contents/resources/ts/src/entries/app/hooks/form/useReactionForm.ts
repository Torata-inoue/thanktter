import { useForm, UseFormReturn } from 'react-hook-form';

export type ReactionFormType = {
  userId: number;
  commentId: number;
  type: number;
};
type UseReactionFormType = (userId: number, commentId: number) => UseFormReturn<ReactionFormType>;
export const useReactionForm: UseReactionFormType = (userId, commentId) => {
  const methods = useForm<ReactionFormType>({
    defaultValues: { userId, commentId },
  });

  methods.register('type', {
    required: 'リアクションを入力してください',
  });

  return methods;
};

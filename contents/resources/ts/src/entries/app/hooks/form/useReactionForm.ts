import { useForm, UseFormReturn } from 'react-hook-form';

export type ReactionFormType = {
  userId: number;
  type: number;
};
type UseReactionFormType = (userId: number) => UseFormReturn<ReactionFormType>;
export const useReactionForm: UseReactionFormType = (userId) => {
  const methods = useForm<ReactionFormType>({
    defaultValues: { userId },
  });

  methods.register('type', {
    required: 'リアクションを入力してください',
  });

  return methods;
};

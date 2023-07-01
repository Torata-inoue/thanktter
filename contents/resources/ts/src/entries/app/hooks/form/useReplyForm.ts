import { useForm, UseFormReturn } from 'react-hook-form';

export type ReplyFormType = { commentId: number; text: string };
type UseReplyFormType = (commentId: number) => UseFormReturn<ReplyFormType>;
export const useReplyForm: UseReplyFormType = (commentId) => {
  const methods = useForm<ReplyFormType>({
    defaultValues: { commentId },
  });

  methods.register('text', {
    required: '返信本文を入力してください',
    maxLength: {
      value: 500,
      message: '本文は最大500文字までです',
    },
  });

  return methods;
};

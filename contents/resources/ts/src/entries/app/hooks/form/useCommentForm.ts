import { useForm, UseFormReturn } from 'react-hook-form';

export type CommentFormType = {
  text: string;
  nomineeIds: number[];
  images: string[];
};

type UseCommentFormType = () => UseFormReturn<CommentFormType>;
export const useCommentForm: UseCommentFormType = () => {
  const methods = useForm<CommentFormType>({
    defaultValues: {
      nomineeIds: [],
      images: [],
    },
  });

  methods.register('nomineeIds', {
    required: '推薦者を選択してください',
    maxLength: {
      value: 10,
      message: '推薦できるのは最大10人までです',
    },
  });

  methods.register('text', {
    required: '本文を入力してください',
    maxLength: {
      value: 1000,
      message: '本文は最大1000文字までです',
    },
  });

  return methods;
};

import { useForm, UseFormReturn } from 'react-hook-form';

export type CommentFormType = {
  text: string;
  nomineeIds: number[];
  images: File[];
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

  methods.register('images', {
    validate: {
      lessThanFour: (files) => files.length <= 4 || '添付できる画像は最大4枚までです',
      extension: (files) =>
        files.every((file) => ['image/png', 'image/jpeg', 'image/gif', 'image/jpg'].includes(file.type)) ||
        'jpg, png, gif以外のファイルを添付することはできません',
    },
  });

  return methods;
};

import { useForm, UseFormReturn } from 'react-hook-form';

export type LoginFormType = { mailAddress: string; password: string };

type UseLoginFormType = () => UseFormReturn<LoginFormType>;
export const useLoginForm: UseLoginFormType = () => {
  const methods = useForm<LoginFormType>();

  methods.register('mailAddress', {
    required: 'メールアドレスを入力してください',
    maxLength: {
      value: 50,
      message: 'メールアドレスは最大50文字までです',
    },
  });

  methods.register('password', {
    required: 'パスワードを入力してください',
    maxLength: {
      value: 50,
      message: 'パスワードは最大50文字までです',
    },
  });

  return methods;
};

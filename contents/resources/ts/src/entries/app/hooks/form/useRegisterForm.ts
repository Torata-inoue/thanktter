import { useForm, UseFormReturn } from 'react-hook-form';

export type RegisterFormType = {
  mailAddress: string;
  name: string;
  password: string;
  confirmPassword: string;
};

type UseRegisterFormType = () => UseFormReturn<RegisterFormType>;
export const useRegisterForm: UseRegisterFormType = () => {
  const methods = useForm<RegisterFormType>();
  const inputPassword = methods.watch('password');

  methods.register('mailAddress', {
    required: 'メールアドレスを入力してください',
    maxLength: {
      value: 50,
      message: 'メールアドレスは最大50文字までです',
    },
  });

  methods.register('name', {
    required: '名前を入力してください',
    maxLength: {
      value: 50,
      message: '名前は最大50文字までです',
    },
  });

  methods.register('password', {
    required: 'パスワードを入力してください',
    maxLength: {
      value: 50,
      message: 'パスワードは最大50文字までです',
    },
  });

  methods.register('confirmPassword', {
    required: '確認用パスワードを入力してください',
    maxLength: {
      value: 50,
      message: '確認用パスワードは最大50文字までです',
    },
    validate: {
      same: (value) => value === inputPassword || 'パスワードと同じ文字を入力してください',
    },
  });

  return methods;
};

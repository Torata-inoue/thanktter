import React from 'react';
import { Box, Button, Link, TextField } from '@mui/material';
import { Send } from '@mui/icons-material';
import { Link as RouterLink } from 'react-router-dom';
import { FormProvider, SubmitHandler } from 'react-hook-form';
import { RegisterFormType, useRegisterForm } from '../../hooks/form/useRegisterForm';
import { Form } from '../../../../common/components/form/Form';
import { TextDiv } from '../../../../common/components/text/TextDiv';

export const RegisterForm: React.FC = () => {
  const methods = useRegisterForm();
  const { register } = methods;
  const onSubmit: SubmitHandler<RegisterFormType> = (data) => {};

  return (
    <FormProvider {...methods}>
      <Form<RegisterFormType> onSubmit={onSubmit}>
        <TextDiv>新規登録</TextDiv>
        <TextDiv>メールアドレス</TextDiv>
        <TextField fullWidth placeholder="メールアドレス" {...register('mailAddress')} />
        <TextDiv>名前</TextDiv>
        <TextField fullWidth placeholder="名前" {...register('mailAddress')} />
        <TextDiv>パスワード</TextDiv>
        <TextField fullWidth type="password" placeholder="パスワード" {...register('mailAddress')} />
        <TextDiv>確認用パスワード</TextDiv>
        <TextField fullWidth type="password" placeholder="確認用パスワード" {...register('mailAddress')} />
        <Box
          sx={{
            display: 'flex',
            justifyContent: 'space-between',
          }}
        >
          <Box>
            <Button type="submit" variant="contained" endIcon={<Send />}>
              送信する
            </Button>
          </Box>
          <TextDiv>
            <Link underline="none" component={RouterLink} to="/login">
              すでにアカウントをお持ちの方はこちら
            </Link>
          </TextDiv>
        </Box>
      </Form>
    </FormProvider>
  );
};

import React from 'react';
import { Send } from '@mui/icons-material';
import { Link as RouterLink, useNavigate } from 'react-router-dom';
import { Box, Button, Link, TextField } from '@mui/material';
import { FormProvider, SubmitHandler } from 'react-hook-form';
import { TextDiv } from '../../../../common/components/text/TextDiv';
import { Form } from '../../../../common/components/form/Form';
import { useSetAuth } from '../../../../common/states/atoms/auth';
import { LoginFormType, useLoginForm } from '../../hooks/form/useLoginForm';

export const LoginForm: React.FC = () => {
  const methods = useLoginForm();
  const setAuth = useSetAuth();
  const navigate = useNavigate();

  const onSubmit: SubmitHandler<LoginFormType> = (data) => {
    // postLoginApi(data)
    navigate('/');
  };

  return (
    <FormProvider {...methods}>
      <Form<LoginFormType> onSubmit={onSubmit}>
        <TextDiv>ログイン</TextDiv>
        <TextField fullWidth placeholder="メールアドレス" {...methods.register('mailAddress')} />
        <TextField fullWidth type="password" placeholder="パスワード" {...methods.register('password')} />
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
            <Link underline="none" component={RouterLink} to="/register">
              新規登録はこちら
            </Link>
            <br />
            <Link underline="none" component={RouterLink} to="/reset">
              パスワードを忘れた方はこちら
            </Link>
          </TextDiv>
        </Box>
      </Form>
    </FormProvider>
  );
};

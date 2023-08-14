import axios from 'axios';
import { api } from '../../../../common/utils/api';
import { LoginFormType } from '../../hooks/form/useLoginForm';
import { AuthType } from '../../../../common/constans/auth';

type PostLoginApi = (data: LoginFormType) => Promise<{ user: AuthType }>;
export const postLoginApi: PostLoginApi = (data) =>
  axios.get('/sanctum/csrf-cookie').then(() => api('/login', 'POST', data));

type PostLogoutApiType = () => Promise<void>;
export const postLogoutApi: PostLogoutApiType = () => api('/logout', 'POST');

import { api } from '../../../../common/utils/api';
import { LoginFormType } from '../../hooks/form/useLoginForm';
import { AuthType } from '../../../../common/constans/auth';

type PostLoginApi = (data: LoginFormType) => Promise<{ user: AuthType }>;
export const postLoginApi: PostLoginApi = (data) =>
  api('/login', 'POST', {
    data,
  });

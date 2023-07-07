import { api } from '../../utils/api';
import { AuthType } from '../../constans/auth';

type FindAuthApiType = () => Promise<AuthType | null>;
export const findAuthApi: FindAuthApiType = async () => {
  const res = await api<{ user: AuthType | null }>('/auth', 'GET');
  return res.user;
};

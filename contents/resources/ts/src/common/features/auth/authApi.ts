import { api } from '../../utils/api';

export type AuthType = {
  id: number;
  name: string;
  icon: string;
};
type FindAuthApiType = () => Promise<AuthType>;
export const findAuthApi: FindAuthApiType = () => api<AuthType>('/auth', 'GET');

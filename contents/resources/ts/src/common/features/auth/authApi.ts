import { api } from '../../utils/api';
import { AuthType } from '../../constans/auth';

type FindAuthApiType = () => Promise<AuthType>;
export const findAuthApi: FindAuthApiType = () => api<AuthType>('/auth', 'GET');

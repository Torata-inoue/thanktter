import { api } from '../../../../common/utils/api';
import { UserType } from '../../constants/user';

type GetUserListApiType = () => Promise<UserType[]>;
export const getUserListApi: GetUserListApiType = () => api<UserType[]>('/user/list', 'GET');

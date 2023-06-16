import { api } from '../../../../common/utils/api';

export type UserType = { id: number; name: string; icon: string };
type GetUserListApiType = () => Promise<UserType[]>;
export const getUserListApi: GetUserListApiType = () => api<UserType[]>('/user/list', 'GET');

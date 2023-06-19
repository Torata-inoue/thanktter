import { CommentType } from '../../constants/comment';
import { api } from '../../../../common/utils/api';

type GetCommentsAPIType = (page?: number) => Promise<CommentType[]>;
export const getCommentsAPI: GetCommentsAPIType = async (page = 1) =>
  api<CommentType[]>(`/comment?page=${page}`, 'GET');

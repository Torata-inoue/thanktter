import { api } from '../../../../common/utils/api';
import { CommentType } from '../../constants/comment';
import { ReplyFormType } from '../../hooks/form/useReplyForm';

type PostCommentApiType = (data: FormData) => Promise<CommentType[]>;
export const postCommentApi: PostCommentApiType = (data) =>
  api('/comment', 'POST', data, {
    headers: {
      'Content-Type': 'multipart/form-data',
    },
  });

type PostReplyApiType = (data: ReplyFormType) => Promise<CommentType>;
export const postReplyApi: PostReplyApiType = (data) => api('/reply', 'POST', data);

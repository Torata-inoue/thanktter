import { ReactionFormType } from '../../hooks/form/useReactionForm';
import { CommentType } from '../../constants/comment';
import { api } from '../../../../common/utils/api';
import { AuthType } from '../../../../common/constans/auth';

type ReactionResponse = { auth: AuthType; comment: CommentType };
type PostReactionType = (data: ReactionFormType) => Promise<ReactionResponse>;
export const postReaction: PostReactionType = (data) => api<ReactionResponse>('/reaction', 'POST', data);

import { UserType } from './user';

type ReactionType = {
  good: number;
  thanks: number;
  fight: number;
};

type ReplyType = {
  user: UserType;
  text: string;
};

export type CommentType = {
  id: number;
  text: string;
  createdAt: string;
  user: UserType;
  nominees: UserType[];
  reactions: ReactionType;
  replies: ReplyType[];
};

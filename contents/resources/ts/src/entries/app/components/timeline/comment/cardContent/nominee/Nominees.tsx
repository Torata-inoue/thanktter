import React from 'react';
import { useFormContext } from 'react-hook-form';
import { Link as RouterLink } from 'react-router-dom';
import { Avatar, Badge, Box, IconButton, Link } from '@mui/material';
import { ThumbUpAlt } from '@mui/icons-material';
import { UserType } from '../../../../../constants/user';
import { ReactionTooltip } from '../reaction/ReactionTooltip';
import { TextDiv } from '../../../../../../../common/components/text/TextDiv';
import { ReactionFormType } from '../../../../../hooks/form/useReactionForm';
import { reactionsObject } from '../../../../../constants/reactions';
import { ReactionForm } from '../reaction/ReactionForm';

const BadgeContent: React.FC = () => (
  <ThumbUpAlt
    sx={{
      backgroundColor: (theme) => theme.palette.primary.main,
      color: (theme) => theme.palette.background.paper,
      borderRadius: '50%',
    }}
    fontSize="small"
  />
);

type NomineeProps = UserType;
const Nominee: React.FC<NomineeProps> = ({ id, icon, name }) => {
  const { setValue } = useFormContext<ReactionFormType>();

  const handleOnClick: React.MouseEventHandler<HTMLButtonElement> = () => {
    setValue('type', reactionsObject.good);
  };

  return (
    <Box sx={{ textAlign: 'center' }}>
      <ReactionTooltip>
        <IconButton type="submit" onClick={handleOnClick}>
          <Badge
            overlap="circular"
            anchorOrigin={{ vertical: 'bottom', horizontal: 'right' }}
            badgeContent={<BadgeContent />}
          >
            <Avatar src={icon} alt={name} />
          </Badge>
        </IconButton>
      </ReactionTooltip>
      <TextDiv textAlign="center">
        <Link underline="none" component={RouterLink} to={`/user/${id}`}>
          {name}
        </Link>
      </TextDiv>
    </Box>
  );
};

type NomineesProps = { nominees: UserType[] };
export const Nominees: React.FC<NomineesProps> = ({ nominees }) => (
  <Box sx={{ display: 'flex', flexWrap: 'wrap' }}>
    {nominees.map((user) => (
      <ReactionForm userId={user.id}>
        <Nominee key={user.name} {...user} />
      </ReactionForm>
    ))}
  </Box>
);

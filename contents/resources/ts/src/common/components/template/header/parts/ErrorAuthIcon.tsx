import React from "react";
import {FallbackProps} from "react-error-boundary";
import {Avatar} from "@mui/material";

export const ErrorAuthIcon: React.FC<FallbackProps> = () => <Avatar alt="error" />;

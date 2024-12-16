import { Navigate } from "react-router-dom";

const Protector = ({ children }: { children: JSX.Element }) => {
  return localStorage.getItem("auth_token") ? (
    children
  ) : (
    <Navigate to="/login" />
  );
};

export default Protector;

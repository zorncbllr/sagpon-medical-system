import { useNavigate } from "react-router-dom";
import { invalidateToken } from "../services/api";

function useInvalidateSession() {
  const navigate = useNavigate();

  const invalidate = () => {
    invalidateToken();
    navigate("/login");
  };

  return { invalidate };
}

export default useInvalidateSession;

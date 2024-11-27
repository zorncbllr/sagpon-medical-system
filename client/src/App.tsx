import { Route, Routes } from "react-router-dom";
import Login from "./pages/login";
import Register from "./pages/register";
import Home from "./pages/home";
import Dashboard from "./pages/dashboard";

function App() {
  return (
    <Routes>
      <Route path="/" Component={Home} />
      <Route path="/login" Component={Login} />
      <Route path="/register" Component={Register} />
      <Route path="/dashboard" Component={Dashboard} />
    </Routes>
  );
}

export default App;

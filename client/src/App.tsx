import { Route, Routes } from "react-router-dom";
import { routes } from "./routes/routes";
import Protector from "./components/auth/protector";

function App() {
  return (
    <Routes>
      {routes.map(({ path, component: Component, isProtected }, index) => {
        if (isProtected) {
          return (
            <Route
              key={index}
              path={path}
              element={
                <Protector>
                  <Component />
                </Protector>
              }
            />
          );
        }

        return <Route key={index} path={path} element={<Component />} />;
      })}
    </Routes>
  );
}

export default App;

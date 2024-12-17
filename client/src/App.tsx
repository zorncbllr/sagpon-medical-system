import { Route, Routes } from "react-router-dom";
import { routes } from "./routes/__routes";
import Protector from "./components/auth/protector";
import LayoutProvider from "./components/layout";

function App() {
  return (
    <LayoutProvider>
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
    </LayoutProvider>
  );
}

export default App;

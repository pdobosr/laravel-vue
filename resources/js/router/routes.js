function page (path) {
  return () => import(/* webpackChunkName: '' */ `~/pages/${path}`).then(m => m.default || m)
}

export default [
  { path: '/', name: 'dashboard', component: page('dashboard/index.vue') },
  { path: '*', component: page('errors/404.vue') }
]

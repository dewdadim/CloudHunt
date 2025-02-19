export function useRoute(routeName: string) {
  var fullURL

  try {
    fullURL = route(routeName)
  } catch (e) {
    console.log('Route not in the list:', e)
    return undefined
  }
  var uri = new URL(fullURL).pathname

  return {
    fullURL,
    uri,
  }
}

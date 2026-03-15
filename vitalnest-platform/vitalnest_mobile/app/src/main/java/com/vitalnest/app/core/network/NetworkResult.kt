package com.vitalnest.app.core.network

/**
 * Sealed class representing the result of a network operation
 */
sealed class NetworkResult<out T> {
    data class Success<T>(val data: T) : NetworkResult<T>()
    data class Error(val message: String, val code: Int? = null) : NetworkResult<Nothing>()
    data object Loading : NetworkResult<Nothing>()

    fun <R> map(transform: (T) -> R): NetworkResult<R> {
        return when (this) {
            is Success -> Success(transform(data))
            is Error -> Error(message, code)
            is Loading -> Loading
        }
    }

    suspend fun <R> flatMap(transform: suspend (T) -> NetworkResult<R>): NetworkResult<R> {
        return when (this) {
            is Success -> transform(data)
            is Error -> Error(message, code)
            is Loading -> Loading
        }
    }

    inline fun onSuccess(action: (T) -> Unit): NetworkResult<T> {
        if (this is Success) action(data)
        return this
    }

    inline fun onError(action: (String, Int?) -> Unit): NetworkResult<T> {
        if (this is Error) action(message, code)
        return this
    }

    inline fun onLoading(action: () -> Unit): NetworkResult<T> {
        if (this is Loading) action()
        return this
    }
}

/**
 * Extension function to convert a suspend function to NetworkResult
 */
suspend fun <T> safeApiCall(apiCall: suspend () -> T): NetworkResult<T> {
    return try {
        NetworkResult.Success(apiCall())
    } catch (e: retrofit2.HttpException) {
        val errorMessage = when (e.code()) {
            400 -> "Bad request"
            401 -> "Unauthorized. Please login again"
            403 -> "Access denied"
            404 -> "Resource not found"
            422 -> "Validation error"
            500 -> "Server error. Please try again later"
            else -> "Something went wrong"
        }
        NetworkResult.Error(errorMessage, e.code())
    } catch (e: java.io.IOException) {
        NetworkResult.Error("No internet connection. Please check your network")
    } catch (e: Exception) {
        NetworkResult.Error(e.message ?: "An unexpected error occurred")
    }
}

